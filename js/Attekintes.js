window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "dark2", // "light1", "light2", "dark1", "dark2"
        title: {
            text: "Pénz változás"
        },
        axisY: {
            title: "Pénz összeg változása (Ft)"
        },
        data: [{
            type: "column",
            showInLegend: true,
            legendMarkerColor: "grey",
            legendText: "MMbbl = one million barrels",
            dataPoints: [
                { y: 45000, label: "Január" },
                { y: -21000, label: "Február" },
                { y: 6000, label: "Március" },
                { y: 15000, label: "Április" },
                { y: -18000, label: "Május" },
                { y: 40000, label: "Június" },
                { y: 17000, label: "Július" },
                { y: 14000, label: "Augusztus" },
                { y: 45000, label: "Szeptember" },
                { y: 450, label: "Október" },
                { y: -3000, label: "November" },
                { y: 25000, label: "December" }
            ]
        }]
    });
    chart.render();

}

function adatKiir(adatok)
{
  console.log(adatok);
}

function kulonbseg() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/szakdolgozat.php/kulonbseg");
    xhr.send();
    xhr.addEventListener("readystatechange", function () {
      if (this.readyState == 4) 
      {
        if (this.status == 200) 
        {
          let data = JSON.parse(this.responseText);
          //console.log(data);
          adatKiir(data);
        }
      }
    })
  }
  
  window.addEventListener("load", kulonbseg);