function $(id) {
  return document.getElementById(id);
}

var clickedID;

function tablazat2(adatok) {
  var tabla = $("tablazat");
  let i = 0;
  tabla.innerHTML = "";
  for (let adat of adatok) {
    i++;
    tabla.innerHTML += "<tr id='" + adat.ID + "'><td id='szamla" + adat.ID + "'>" + adat.Nev + "</td><td id='osszeg" + adat.ID + "'>" + adat.Penzosszeg + "</td><td><button onclick='szerk1(" + adat.ID + ")' type='button' id='szerk" + adat.ID + "' class='btn btn-primary' data-toggle='modal' data-target='#szamlaModal'>Szerkesztés</button></td>" +
      "<td><button onclick=torles(" + adat.ID + ") class='btn btn-primary' id='torles" + adat.ID + "'>Törlés</button></td></tr>";
  }
}

function tablazat1() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../php/szakdolgozat.php/szamlak");
  xhr.send();
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let data = JSON.parse(this.responseText);
        tablazat2(data);
      }
    }
  })
}

function szerk1(ID) {
  let szamla = $("szamla" + ID).innerText;
  let osszeg = $("osszeg" + ID).innerText;

  $("modalSzamla").defaultValue = szamla;
  $("modalOsszeg").defaultValue = osszeg;

  clickedID = ID;
}

function szerk2() {
  $("modalHiba").innerHTML = "";
  $("modalMentes").setAttribute("data-dismiss", "modal");
  if ($("modalSzamla").value != "" && $("modalOsszeg").value != "")
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/szakdolgozat.php/szerkesztes");
    xhr.send(JSON.stringify(
      {
        "osszeg": $("modalOsszeg").value,
        "szamla": $("modalSzamla").value,
        "id": clickedID
      }
    ));
    xhr.addEventListener("readystatechange", function () {
      if (this.readyState == 4) {
        if (this.status == 200) {
          let data = JSON.parse(this.responseText);
          tablazat2(data);
        }
      }
    })
  }
  else
  {
    $("modalMentes").removeAttribute("data-dismiss");
    $("modalHiba").innerHTML = "Kérem töltse ki a mezőket!";
  }
}

function torles(ID) {
  if (confirm("Biztos vagy benne hogy törölni szeretnéd ezt a számlát?")) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/szakdolgozat.php/szamlatorles");
    xhr.send(JSON.stringify
      (
        {
          "id": ID
        }
      ));
    xhr.addEventListener("readystatechange", function () {
      if (this.readyState == 4) {
        if (this.status == 200) {
          let data = JSON.parse(this.responseText);
          tablazat2(data);
        }
      }
    })
  }
}

function ujSzamla1() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/szakdolgozat.php/ujszamla");
  xhr.send(JSON.stringify
    (
      {
        "szamla": $("szamla").value,
        "osszeg": $("osszeg").value,
      }
    ));
}

$("gomb").addEventListener("click", ujSzamla1)
$("modalMentes").addEventListener("click", szerk2);
window.addEventListener("load", tablazat1);