// Initialize and add the map
function initMap() {
  // The location of Vasteras
  const vasteras = { lat: 57.3365, lng: 12.5164 };
  
  // The map, centered at Vasteras
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: vasteras,
  });
  const contentString = `<div id="content">
<div id="siteNotice"></div>
<h1 id="firstHeading" class="firstHeading">Vasteras</h1>
<div id="bodyContent">
<p><b>Patient's name:</b> <a href="">Patient 1</a></p>
<br>
<p><b>Patient's email:</b> x@gmail.com</p>
<br>
<p>Patient is located in <b>Vasteras</b>, a municipality in Sweden.</p>
<p><b>Location coordinates:</b> 59.6567, 16.6709</p>
</div>
</div>`;
  
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 400,
    ariaLabel: "Vasteras",
  });
  
  const marker = new google.maps.Marker({
    position: vasteras,
    map,
    title: "Vasteras Municipality, Sweden",
  });
  
  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
    });
  });
}

window.initMap = initMap;