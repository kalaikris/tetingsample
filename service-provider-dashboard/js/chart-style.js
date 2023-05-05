

var options = {
	animationEnabled: true,
    animationDuration: 6000, 
    theme: "light2",
	axisX: {
		valueFormatString: "MMM",
        labelFontSize: 14,
    	lineThickness: .2,
	tickThickness: 0
	},
	axisY: {
		includeZero: true,
        labelFontSize: 14,
        lineThickness: 0,
	 gridThickness: .3,
	tickLength: 0
	},
    toolTip: {
			backgroundColor: "#3e5068"
		},
data: [{
		type: "splineArea",
        lineThickness: 4,
        markerType: "circle",  //"", "square", "cross", "none"
		markerSize: 0,
        hoveredMarkerSize: 30,
        markerColor: "#987ad2",
        indexLabelFontSize: 12,
        color: "#ece6fa",
		xValueFormatString: "MMM",
	   yValueFormatString: "#,##0.##" % "",
	   markerBorderThickness: 9,
		markerBorderColor: "#987ad2",
        lineColor: "#987ad2",
        labelFontSize: 20,
        toolTipContent: " <small style=\"color:#ffffff\">{x}</small><br><b style=\"color:#ffffff\">{y}</b>' '<b style=\"color:#ffffff\">booking</b>",
		dataPoints: [
			{ x: new Date(2017, 0), y: 10 },
			{ x: new Date(2017, 1), y: 40},
			{ x: new Date(2017, 2), y: 15 },
			{ x: new Date(2017, 3), y: 30},
			{ x: new Date(2017, 4), y: 5},
			{ x: new Date(2017, 5), y: 40 },
			{ x: new Date(2017, 6), y: 20},
			{ x: new Date(2017, 7), y: 50 },
			{ x: new Date(2017, 8), y: 10},
			{ x: new Date(2017, 9), y: 16},
			{ x: new Date(2017, 10), y: 20 },
			{ x: new Date(2017, 11), y: 5 }
		]
	}]
       
};
$("#chartContainer").CanvasJSChart(options);
