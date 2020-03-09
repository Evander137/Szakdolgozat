function $(id) {
  return document.getElementById(id);
}

function adatKiir(adatok) {
  var dps = [];

  for (let adat of adatok) {
    dps.push({
      y: adat.Osszeg,
      label: adat.Nev
    });
  }

  /*let csere = false;
  do{
    csere = false;
    for(let i = 0; i < dps.length-1; i++)
    {
      if(dps[i].y < dps[i+1].y)
      {
        csere = true;
        let temp = dps[i];
        dps[i] = dps[i+1];
        dps[i+1] = temp;
      }
    }
  }
  while(csere);*/

  //console.log(dps);

  var chart = new CanvasJS.Chart("chartContainer",
    {
      theme: "dark2", // "light1", "light2", "dark1", "dark2"
      exportEnabled: true,
      animationEnabled: true,
      title:
      {
        text: "(PÉLDA) Havi költségvetés"
      },
      data:
        [{
          type: "pie",
          startAngle: 25,
          toolTipContent: "<b>{label}</b>: {y}ft",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 16,
          indexLabel: "{label} - {y}Ft",
          dataPoints: dps
        }]
    });

  chart.render();
}

function kordiagram() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../php/szakdolgozat.php/kordiagram");
  xhr.send();
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText);
        adatKiir(data);
      }
    }
  })
}

function kategoriak2(adatok) {
  var select = $("kategoria");
  let i = 1;
  for (let adat of adatok) {
    let option = document.createElement("option");
    option.setAttribute("value", adat.ID);
    option.text = adat.Nev;
    if (adat.Koltsege == 0) {
      select.add(option, select[i]);
      i++;
    }
    else if (adat.Koltsege == 1) {
      select.add(option);
    }
  }
}

function kategoriak1() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../php/szakdolgozat.php/kategoriak");
  xhr.send();
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText);
        kategoriak2(data);
      }
    }
  })
}

function szamlak2(adatok) {
  //console.log(adatok);
  var select = $("szamla");
  for (let adat of adatok) {
    let option = document.createElement("option");
    option.setAttribute("value", adat.ID);
    option.text = adat.Nev;
    select.add(option);
  }
}

function szamlak1() {
  $("datum").valueAsDate = new Date();
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../php/szakdolgozat.php/szamlak");
  xhr.send();
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText);
        szamlak2(data);
      }
    }
  })
}

function felvitel() {
  if ($("megjegyzes").value.length < 31 && $("osszeg").value > 0)
  {
    $("hibasAdatok").setAttribute("hidden","");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/szakdolgozat.php/felvitel");
    xhr.send(JSON.stringify
      (
        {
          "kategoria": $("kategoria").value,
          "szamla": $("szamla").value,
          "osszeg": $("osszeg").value,
          "datum": $("datum").value,
          "megjegyzes": $("megjegyzes").value
        }
      ));
      $("siker").removeAttribute("hidden");
      $("megjegyzes").value = "";
      $("osszeg").value = "";
      kordiagram();
  }
  else
  {
    $("siker").setAttribute("hidden","");
    $("hibasAdatok").removeAttribute("hidden");
  }
}

function megjegyzesLimit() {
  if ($("megjegyzes").value.length > 30) {
    $("megjegyzes").style.border = "solid 2px red";
  }
  else {
    $("megjegyzes").style.border = "none";
  }
}

window.addEventListener("load", kordiagram);
window.addEventListener("load", szamlak1);
window.addEventListener("load", kategoriak1);
$("megjegyzes").addEventListener("input", megjegyzesLimit);
$("felvitel").addEventListener("click", felvitel);
