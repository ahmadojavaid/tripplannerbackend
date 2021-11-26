let state = {
  places: {},
  links: {},
  placeCount: 0,
  locations: [],
  editlocation:null,
};

function initProcess(data,placelocation=null) {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
 state = { ...state, links: data };
  handleCountries(data);

  //handleLocations();

  $(document).on("click", "#country-tabs .nav-link", handlePlaces);

  $(document).on("click", "#edit-intro", handleIntroEdit);
  $(document).on("hidden.bs.modal", "#intro-modal", updateIntro);

  $(document).on("click", "#country-tabs button.add-place", displayPlace);
  $(document).on("click", "button.add-experience", displayExperience);
  $(document).on("click", "button.add-property", displayProperty);

  $(document).on("click", ".add-itinerary-place", addPlace);
  $(document).on("click", ".add-itinerary-experience", addExperience);
  $(document).on("click", ".add-itinerary-property", addProperty);

  $(document).on("click", ".leaflet-marker-icon", loadPopupContent);
  if(placelocation!=null){
    let newState = { ...state };
    newState = { ...newState, locations: placelocation,editlocation:true};
    state = { ...newState };
  }


  // $(document).on("click", ".handle-transport", handleTransport);
}

function handleIntroEdit() {
  $("#trip-title").val(state.title);
  $("#trip-description").val(state.description);
  $("#intro-modal").modal("show");
}

function updateIntro() {
  const introSection = $("#trip-intro-section");
  const title = $("#trip-title").val();
  const description = $("#trip-description").val();
  introSection.find(".section-title>span").html(title);
  introSection.find(".section-description").html(description);
  const newState = { ...state };
  state = { ...newState, title: title, description: description };
  const placeId = $(".handle-transport").attr("data-id");
  $.ajax({
    type: "GET",
    url: state.links.add_intro,
    data: {
      title: title, description:description
    },
    success: function(response) {
    }
  });
}

function handleCountries() {
  $.ajax({
    type: "POST",
    url: state.links.country,
    success: function(response) {
      $("#country-tabs .nav-tabs.tabbable").html(response);
      handlePlaces();
    }
  });
}

function handleLocations() {
  $.ajax({
    type: "GET",
    url: state.links.location,
    success: function(response) {
      let newState = { ...state };
      newState = { ...newState, locations: response };
      state = { ...newState };
      initMap();

      // $("#country-tabs .nav-tabs.tabbable").html(response);
      // handlePlaces();
    }
  });
}

function handlePlaces() {
  const activeTab = $("#country-tabs").find(".nav-link.active");
  $.ajax({
    type: "POST",
    url: state.links.places,
    data: {
      id: activeTab.attr("data-id")
    },
    success: function(response) {
      updateLocation(activeTab.attr("data-id"));
      $("#country-tabs .tab-pane#place-list").html(response);

    }
  });
}

function displayPlace() {
  const context = $(this);
  const placeId = context.attr("data-id");
  $.ajax({
    type: "POST",
    url: state.links.place,
    data: {
      id: placeId
    },
    beforeSend: function() {
      $(".add-to-itinerary").addClass("add-itinerary-place");
      $(".add-itinerary-place").attr("data-id", placeId);
    },
    success: function(response) {
      $(".trip-flow-1").toggleClass("d-none");
      $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
      $(".trip-custom-flow")
        .toggleClass("d-none")
        .html(response);
    }
  });
}

function displayProperty() {
  const context = $(this);
  const propertyId = context.attr("data-id");

  $.ajax({
    type: "POST",
    url: state.links.property,
    data: {
      id: propertyId
    },
    beforeSend: function() {
      $(".add-to-itinerary").addClass("add-itinerary-property");
      $(".add-itinerary-property").attr("data-id", propertyId);
    },
    success: function(response) {
      $(".trip-flow-1").toggleClass("d-none");
      $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
      $(".trip-custom-flow")
        .toggleClass("d-none")
        .html(response);
    }
  });
}

function displayExperience() {
  const context = $(this);
  const experienceId = context.attr("data-id");
  $.ajax({
    type: "POST",
    url: state.links.experience,
    data: {
      id: experienceId
    },
    beforeSend: function() {
      $(".add-to-itinerary").addClass("add-itinerary-experience");
      $(".add-itinerary-experience").attr("data-id", experienceId);
    },
    success: function(response) {
      $(".trip-flow-1").toggleClass("d-none");
      $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
      $(".trip-custom-flow")
        .toggleClass("d-none")
        .html(response);
    }
  });
}

function addPlace() {
  //alert(1122)
  const placeDetails = $("#place-data-details");
  const placeId = placeDetails.attr("place-id");
  const place = {
    id: placeId,
    latitude: placeDetails.attr("place-latitude"),
    longitude: placeDetails.attr("place-longitude"),
    airport: {
      id: placeDetails.attr("airport-id"),
      latitude: placeDetails.attr("airport-latitude"),
      longitude: placeDetails.attr("airport-longitude")
    },
    order: state.placeCount
  };

  const newState = { ...state };
  let places = { ...newState.places, [placeId]: place };
  state = { ...newState, places: places, placeCount: newState.placeCount + 1 };

  $(".trip-flow-1").toggleClass("d-none");
  $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
  $(".trip-custom-flow").toggleClass("d-none");

  $(".places-added").removeClass("d-none");

  updateMap();

  $.ajax({
    type: "POST",
    url: state.links.add_place,
    data: {
      id: placeId
    },
    async: false,
    success: function(response) {
      $(".places-added .panel-group").append(response);
      $(".add-to-itinerary").removeClass("add-itinerary-place");
      $('.date-above-place').text($('#txtDate').val());
      $('.trip-date').text($('#txtDate').val());
      $('.save-tripx').prop('disabled', false);
      $(".update-tripx").prop('disabled',false);
      getdate();
    }
  });
  $('.follow_Date').css('display','')
}

function addProperty() {
  const propertyDetails = $("#property-data-details");
  const propertyId = propertyDetails.attr("property-id");
  const placeId = propertyDetails.attr("place-id");

  const property = {
    id: propertyId,
    place_id: placeId,
    latitude: propertyDetails.attr("property-latitude"),
    longitude: propertyDetails.attr("property-longitude")
  };
  const newState = { ...state };
  let place = { ...newState.places[placeId], property: property };

  let places = { ...newState.places, [placeId]: place };
  state = { ...newState, places: places };

  $(".trip-flow-1").toggleClass("d-none");
  $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
  $(".trip-custom-flow").toggleClass("d-none");

  updateMap();

  $.ajax({
    type: "POST",
    url: state.links.add_property,
    data: {
      id: propertyId
    },
    success: function(response) {
      // $(".place-property-section").html(response);
      var classx = placeId+'-place-property-section';
      $("."+classx).html(response);
      $(".add-to-itinerary").removeClass("add-itinerary-property");
    }
  });
}

function addExperience() {
  const experienceDetails = $("#experience-data-details");
  const experienceId = experienceDetails.attr("experience-id");
  const placeId = experienceDetails.attr("place-id");

  const newState = { ...state };

  const experience = {
    id: experienceId,
    place_id: placeId,
    latitude: experienceDetails.attr("experience-latitude"),
    longitude: experienceDetails.attr("experience-longitude")
  };

  const experiences = {
    ...newState.places[placeId].experiences,
    [experienceId]: experience
  };

  const experienceList = Object.keys(experiences);

  let place = { ...newState.places[placeId], experiences: experiences };
  let places = { ...newState.places, [placeId]: place };
  state = { ...newState, places: places };

  $(".trip-flow-1").toggleClass("d-none");
  $(".trip-custom-navbar , .trip-simple-navbar").toggleClass("d-none");
  $(".trip-custom-flow").toggleClass("d-none");

  updateMap();
  $.ajax({
    type: "POST",
    url: state.links.add_experience,
    data: {
      id: experienceId,
      list: experienceList
    },
    success: function(response) {
      // $(".place-experience-section").html(response);
      var classx = placeId+'-place-experience-section';
      $("."+classx).html(response);
      $(".add-to-itinerary").removeClass("add-itinerary-experience");
    }
  });
}

function updateMap() {
  getLocations();
}

function getLocations() {
  let locations = [];
  const places = { ...state.places };
  const placeArr = Object.values(places);/*return array*/
  placeArr.sort(sortPlaces);
  placeArr.forEach(place => {
    if (place.order == 0)
      locations.push([place.airport.latitude, place.airport.longitude, 1]);
    locations.push([place.latitude, place.longitude, 0]);
    if (place.hasOwnProperty("property")) {
      locations.push([place.property.latitude, place.property.longitude, 0]);
    }
    if (place.hasOwnProperty("experiences")) {
      for (const key in place.experiences) {
        const experience = place.experiences[key];
        locations.push([experience.latitude, experience.longitude, 0]);
      }
    }
  });
  initMap(locations, locations[0]);
}

function initMap(locations = null, center) {
  // var container = L.DomUtil.get("trip-map");
  // if (container != null) container._leaflet_id = null;

  // var map;
  // console.log("map", ma);
  // map = new L.map("trip-map", {
  //   center: center ? center : [-8.7832, -55.4915],
  //   zoom: 2,
  //   attributionControl: false,
  //   // zoomControl: false,
  //   layers: [L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {})]
  // });

  document.getElementById("trip-map").innerHTML =
    "<div id='map'class='map-right' style='width: 100%; height: 100%;'></div>";
  var osmUrl = "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    osmAttribution =
      'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,' +
      ' <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    osmLayer = new L.TileLayer(osmUrl, {
      maxZoom: 100,
      attribution: osmAttribution
    });
  var map = new L.Map("map");
  map.setView(new L.LatLng(-8.7832, -55.4915), 2);
  map.addLayer(osmLayer);
  // var validatorsLayer = new OsmJs.Weather.LeafletLayer({ lang: "en" });
  // map.addLayer(validatorsLayer);

  // ===========================================Custom Design============================================

  planes = [];
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
  for (var i = 0; i < state.locations.length; i++) {
    new L.marker([state.locations[i][0], state.locations[i][1]], {
      icon: markerIcon(state.locations[i][2])
    })
      .bindPopup(initialContent(state.locations[i]), {
        closeButton: true,
        maxWidth: 280,
        minWidth: 280
      })
      .addTo(map);
  }
}

function initialContent(data) {
  return `<div data-id=${data[3]} data-type=${data[4]}></div>`;
}

function markerIcon(location = false) {
  let classNames = "stage-marker highlighted-location";

  if (location == 0) classNames = "stage-marker";
  else if (location == 1) classNames = "stage-marker location";

  return L.divIcon({
    className: classNames,
    html: "<div></div>",
    iconSize: [15, 15]
  });
}

function sortPlaces(a, b) {
  // a should come before b in the sorted order
  if (a.order < b.order) {
    return -1;
    // a should come after b in the sorted order
  } else if (a.order > b.order) {
    return 1;
    // a and b are the same
  } else {
    return 0;
  }
}

function loadPopupContent() {
  const context = $(".leaflet-popup-content");
  const dataContainer = context.find("div");
  const placeId = dataContainer.attr("data-id");
  const type = dataContainer.attr("data-type");

  $.ajax({
    type: "POST",
    url: state.links.location_popup,
    data: {
      id: placeId,
      type: type
    },
    success: function(response) {
      const content = markerPopupContent(response);
      dataContainer.html(content);
    }
  });
}

function markerPopupContent(location) {
  const content = `<div>
  <div class="leaf-map-card">
    <div class="leaf-map-card-img" style="background: url('${location.image}') no-repeat center center; background-size:cover">
      <button class="btn btn-primary">
        Add <i class="fa fa-plus ml-1"></i>
      </button>
    </div>
    <div class="leaf-map-card-content">
      <h4>${location.name}</h4>
      <p class="max-3-line">
      ${location.description}
      </p>
    </div>
  </div>
</div>`;
  return content;
}

$(document).on("click", ".handle-transport", function(){
  //alert($(this).attr("data-id"));
  const placeId = $(this).attr("data-id");
  $.ajax({
    type: "POST",
    url: state.links.location_transport,
    data: {
      id: placeId
    },
    success: function(response) {

      $("#transportationModal").modal("show");
      $("#transportationModal")
        .find(".modal-transport-content")
        .html(response);
    }
  });

});
// function handleTransport() {
  // const placeId = $(".handle-transport").attr("data-id");
  // $.ajax({
  //   type: "POST",
  //   url: state.links.location_transport,
  //   data: {
  //     id: placeId
  //   },
  //   success: function(response) {
  //     console.log(response);
  //
  //     $("#transportationModal").modal("show");
  //     $("#transportationModal")
  //       .find(".modal-transport-content")
  //       .html(response);
  //   }
  // });
// }
function updateLocation(id){
  $.ajax({
    type: "POST",
    url: state.links.updatelocation,
    data:{
      place_id:id,
    },
    success: function(response) {
      if(state.editlocation){
        let newState = { ...state };
        newState = { ...newState, editlocation: null };
        state = { ...newState };
        initMap();
      }
      else{
        let newState = { ...state };
        newState = { ...newState, locations: response };
        state = { ...newState };
        initMap();
      }

    }
  });
}
