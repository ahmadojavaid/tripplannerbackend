function init(id, locations = null, center) {
  var map = L.map(id, {
    center: center,
    zoom: 5,
    attributionControl: false,
    zoomControl: false,
    layers: [
      L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
        // attribution:
        //   '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      })
    ]
  });
  // ===========================================Custom Design============================================

  var planes = [
    [58.44773, -28.65234, true],
    [52.9354, -23.33496, false],
    [53.01478, -14.32617, false],
    [58.1707, -10.37109, false],
    [59.68993, -0.65918, true]
  ];
  if (locations) planes = locations;

  for (var i = 0; i < planes.length; i++) {
    new L.marker([planes[i][0], planes[i][1]], {
      icon: markerIcon(planes[i][2])
    }).addTo(map);
  }

  const markerLine = L.polyline(planes, {}).addTo(map);
  L.polylineDecorator(markerLine, {
    patterns: [
      {
        offset: "5%",
        repeat: "20%",
        endOffset: 80,
        symbol: L.Symbol.arrowHead({
          pixelSize: 15,

          pathOptions: { fillOpacity: 1, weight: 0 }
        })
      }
    ]
  }).addTo(map);
}

function markerIcon(location = false) {
  return L.divIcon({
    className: location ? "stage-marker location" : "stage-marker",
    html: "<div></div>",
    iconSize: [15, 15]
  });
}
