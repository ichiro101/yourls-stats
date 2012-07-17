var filterIsOn = function() {
	if($("#before-date").val()&& $("#after-date").val()) {
		return true;
	} else {
		return false;
	}
}

var enableFilterDate = function() {
	// if the date fields are filled
	// we need to enable the button
	if(filterIsOn()) {
		$("button#filter-button").removeAttr("disabled");
	} else {
		$("button#filter-button").attr("disabled", "disabled");
	}
}


// parse date from mysql format
//
// source: 
// http://stackoverflow.com/questions/3075577/convert-mysql-datetime-stamp-into-javascripts-date-format
var parseMysqlDate = function(dateString) {
	// Split timestamp into [ Y, M, D, h, m, s ]
	var t = dateString.split(/[- :]/);

	// Apply each element to the Date function
	var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);

	return moment(d);
};

var getStartDate = function(data) {
	var startDate = new Date();

	if(!filterIsOn()) {
		for(var i = 0; i < data.length; i++) {
			dateObject = parseMysqlDate(data[i]["click_time"]);

			if(dateObject < startDate) {
				startDate = dateObject;
			}
		}
	} else {
		return moment($("#before-date").val());
	}

	return moment(startDate);
};

var getEndDate = function(data) {
	var endDate = new Date();

	if(!filterIsOn()) {
		return moment(endDate);
	} else {
		return moment($("#after-date").val());
	}
};

// input: the original data from the database
// output: only the data that is in range will
// be returned, data will be returned in the same
// format
var filterDate = function(data, startDate, endDate) {
	newData = [];

	for(var i = 0; i < data.length; i++) {
		current = moment(parseMysqlDate(data[i]["click_time"]));

		if(startDate <= current &&
				endDate >= current) {
					newData.push(data[i]);
				}
	}

	return newData;
};

var drawDailyChart = function(data, startDate, endDate, redraw) {
	gDrawDailyChart = function() {
		var table = [
			["Date", "Hit Count"]
		];

		var current = moment(startDate);
		while(endDate >= current) {
			var count = 0;
			for(var i = 0; i < data.length; i++) {
				dateObject = parseMysqlDate(data[i]["click_time"]);

				if(current.format("M D YYYY") == dateObject.format("M D YYYY")) {
					count++;
				}
			}
			table.push([current.format("MMMM Do YYYY"), count]);

			current = current.add("days", 1);
		}

		// last one for the today
		for(var i = 0; i < data.length; i++) {
			dateObject = parseMysqlDate(data[i]["click_time"]);

			if(current.format("M D YYYY") == dateObject.format("M D YYYY")) {
				count++;
			}
		}
		table.push([current.format("MMMM Do YYYY"), count]);

		var chartData = google.visualization.arrayToDataTable(table);

		var options = {
			title: 'Daily Hits'
		};

		var chart = new google.visualization.LineChart(document.getElementById('day-chart'));
		chart.draw(chartData, options);
	}
	google.setOnLoadCallback(gDrawDailyChart);
	if(redraw) {
		gDrawDailyChart();
	}
}

var drawHourlyChart = function(data, startDate, endDate, redraw) {
	gDrawHourlyChart = function() {
		var table = [
			["Date", "Hit Count"]
		];

		var current = moment(startDate);
		while(endDate >= current) {
			var count = 0;
			for(var i = 0; i < data.length; i++) {
				dateObject = parseMysqlDate(data[i]["click_time"]);

				if(current.format("M D YYYY HH") == dateObject.format("M D YYYY HH")) {
					count++;
				}
			}
			table.push([current.format("M/D/YYYY HH"), count]);

			current = current.add("hours", 1);
		}

		// last one for the today
		for(var i = 0; i < data.length; i++) {
			dateObject = parseMysqlDate(data[i]["click_time"]);

			if(current.format("M D YYYY HH") == dateObject.format("M D YYYY HH")) {
				count++;
			}
		}
		table.push([current.format("MMMM Do YYYY HH"), count]);


		var chartData = google.visualization.arrayToDataTable(table);

		var options = {
			title: 'Hourly Hits'
		};

		var chart = new google.visualization.LineChart(document.getElementById('hour-chart'));
		chart.draw(chartData, options);
	}
	google.setOnLoadCallback(gDrawHourlyChart);
	if(redraw) {
		gDrawHourlyChart();
	}
}

var parseCountryData = function(data) {
	var countryData = {};
	for(var i = 0; i < data.length; i++) {
		var country = data[i]["country_code"];
		if(country in countryData) {
			countryData[country]++;
		} else {
			countryData[country] = 1;
		}
	}

	return countryData;
}

var drawCountryChart = function(data, startDate, endDate, redraw) {
	drawChart = function() {
		var table = [
			["Country", "Hit Count"]
		];

		countryData = parseCountryData(data);

		for(var key in countryData) {
			table.push([key, countryData[key]]);
		}

		var chartData = google.visualization.arrayToDataTable(table);

		var options = {
			title: 'Hits by Country'
		};

		var chart = new google.visualization.PieChart(document.getElementById('country-chart'));
		chart.draw(chartData, options);
	}
	google.setOnLoadCallback(drawChart);
	if(redraw) {
		drawChart();
	}
}

// The main function that produces data charts
var analyzeData = function(data, redraw) {
	redraw = typeof redraw !== 'undefined' ? redraw : false;


	var startDate = getStartDate(data);
	var endDate = getEndDate(data);

	if(filterIsOn()) {
		data = filterDate(data, startDate, endDate);
	}

	drawDailyChart(data, startDate, endDate, redraw);
	drawHourlyChart(data, startDate, endDate, redraw);
	drawCountryChart(data, startDate, endDate, redraw);
};
