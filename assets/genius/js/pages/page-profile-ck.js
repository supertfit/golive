/*------- Radar Chart -------*/var radarChartData={labels:["Eating","Drinking","Sleeping","Designing","Coding","Partying","Running"],datasets:[{fillColor:"rgba(220,220,220,0.5)",strokeColor:"rgba(220,220,220,1)",pointColor:"rgba(220,220,220,1)",pointStrokeColor:"#fff",data:[65,59,90,81,56,55,40]},{fillColor:"rgba(151,187,205,0.5)",strokeColor:"rgba(151,187,205,1)",pointColor:"rgba(151,187,205,1)",pointStrokeColor:"#fff",data:[28,48,40,19,96,27,100]}]},myRadar=(new Chart(document.getElementById("canvas").getContext("2d"))).Radar(radarChartData,{scaleShowLabels:!0,pointLabelFontSize:10});$(".language-skill1").easyPieChart({barColor:"#78cd51",trackColor:"e9ebec",scaleColor:!1,lineCap:"butt",rotate:-90,lineWidth:10,animate:1e3,onStep:function(e,t,n){$(this.el).find(".percent").text(Math.round(n))}});$(".language-skill2").easyPieChart({barColor:"#67c2ef",trackColor:"e9ebec",scaleColor:!1,lineCap:"butt",rotate:-90,lineWidth:10,animate:1e3,onStep:function(e,t,n){$(this.el).find(".percent").text(Math.round(n))}});$(".language-skill3").easyPieChart({barColor:"#fa603d",trackColor:"e9ebec",scaleColor:!1,lineCap:"butt",rotate:-90,lineWidth:10,animate:1e3,onStep:function(e){this.$el.find("span").text(~~e)}});