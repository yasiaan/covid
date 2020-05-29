//Grab the input
firstLoad();

document.querySelector('.js-go').addEventListener('click',function(){
    var text = document.querySelector('.js-userinput').value;
    getData(text);
});
   
document.querySelector('.js-userinput').addEventListener('keyup',function(e){
    var text = document.querySelector('.js-userinput').value;
    if(e.which === 13){
        getData(text);
    };
});
//the data stuff with the API
function getUrlAJAX(){
    var url = 'https://api.apify.com/v2/key-value-stores/tVaYRsPHLjNdNBu7S/records/LATEST?disableRedirect=true'
    //AJAX Request
    var CORONAAJAXCall = new XMLHttpRequest();
    CORONAAJAXCall.open('GET', url);
    CORONAAJAXCall.send();
    return CORONAAJAXCall;
}


function getData(input){

    getUrlAJAX().addEventListener('load', function(e){
        var data = e.target.response;
        if( input.length !== 0){
            pushToDOM(data,input);
        }else{
            worldData(data);
        }
    });
};
//show the Stats
function firstLoad(){
    getUrlAJAX().addEventListener('load', function(e){
        var data = e.target.response;
        worldData(data);
    });
}
if(document.querySelector('.js-userinput').value === null){

}

function pushToDOM(data,input){
    var response = JSON.parse(data);
    console.log(response);
    var dataList = [['Cases type', 'Number of cases']];
    
    document.querySelector('.js-container').innerHTML = null;
    var found = 0;
    for( var i = 0 ; i < response.length ; i++){
        var countryName = response[i].country;
        if(input.toLowerCase() !== countryName.toLowerCase()) continue;
        console.log(countryName);
        var countryStats = document.createElement('ul');
        countryStats.className = "container-stats"; 
        countryStats.innerHTML = '<li id="name">Country : '+countryName+
                                 '<hr><li>Tested : '+response[i].tested+
                                 '<hr><li>Infected : '+response[i].infected+
                                 '<hr><li>Deceased : '+response[i].deceased+
                                 '<hr><li>Recovered : '+response[i].recovered+
                                 '<hr><li>Last updated : '+response[i].lastUpdatedSource;
        if( typeof response[i].sourceUrl !== 'undefined' ){
            countryStats.innerHTML += '<hr><li>For more information click <a href="'+response[i].sourceUrl+'" target="_blank" title="'+countryName+'\'s covid-19 informations">here</a>';
        }
        found = 1;
        if( response[i].infected != "NA") dataList.push(['Infected',response[i].infected]);
        if( response[i].recovered != "NA") dataList.push(['Recovered',response[i].recovered]);
        if( response[i].deceased  != "NA") dataList.push(['Deceased',response[i].deceased]);
        console.log(dataList);

        document.querySelector('#chart_div').innerHTML = null;
        drawPieChart(dataList, countryName+' statistics ');
    }
    if(found === 0){
        console.log(input+' not found !');
        var countryStats = document.createElement('h1');
        countryStats.className = "container-stats";
        countryStats.innerHTML = '<span id="error">Sorry, we have no information about</span> "'+input+'"';
        document.querySelector('#chart_div').innerHTML = null;
    }
    document.querySelector('.js-container').appendChild(countryStats);        
};

function worldData(data){
    var response = JSON.parse(data);
    var tested = 0, infected = 0, deceased = 0, recovered = 0;
    var dataList = [['Cases type', 'Number of cases']];
    for( var i = 0 ; i < response.length ; i++){
        if( !isNaN(response[i].tested) ) tested += response[i].tested ;
        if( !isNaN(response[i].infected) ) infected += response[i].infected ;
        if( !isNaN(response[i].deceased) ) deceased += response[i].deceased;
        if( !isNaN(response[i].recovered) ) recovered += response[i].recovered;
    };

    document.querySelector('#chart_div').innerHTML = null;
    dataList.push(['Infected', infected], ['Deceased', deceased], ['Recovered', recovered]);
    drawPieChart(dataList, 'World Data');
    console.log('World Data');
    var countryStats = document.createElement('ul');
    countryStats.className = "container-stats";
    countryStats.innerHTML = '<li id="name">World Data '+
                             '<hr><li>Tested : '+tested+
                             '<hr><li>Infected : '+infected+
                             '<hr><li>Deceased : '+deceased+
                             '<hr><li>Recovered : '+recovered;
    document.querySelector('.js-container').innerHTML = null;
    document.querySelector('.js-container').appendChild(countryStats);

}

//Display histogram
function drawPieChart(dataList, countryTitle){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(
            dataList
        );

        var options = {
            title: countryTitle,
            is3D: true,
            // pieHole: 0.4
        };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    };
}

