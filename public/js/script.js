function initMap() {
    // Specify the coordinates for the center of the map
    const center = { lat:30.771784482143765,lng: -122.22408489279735};
    const pos8 = {lat:34.78367685799605, lng: -122.26198616759353};
    const pos = {lat:35.76598431402582, lng: -122.40519524072809}
    // console.log(pos.lat);
    // Create a new map object
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12, // Set the zoom level of the map
      center: center, // Set the center of the map
    });
   
    // Add a marker to the map
    // if(pos && center<pos8){
        const marker = new google.maps.Marker({
        position: center,
        map: map,
        title: "I AM IN BETEEN SAN FRANS AND DIGILYNX", // Set the title of the marker
    });
    // }
   
    const marker5 = new google.maps.Marker({
      position: pos8,
      map: map,
      title: "San Francisco", // Set the title of the marker
    });
    if(pos.lat>center.lat && pos.lat<pos8.lat){
      const marker_4 = new google.maps.Marker({
        position: pos,
        map: map,
        title: "Digilynx", // Set the title of the marker
      });
    }

    map.addListener('click',function(e){

        addMarker(e.latLng);
    });
    function addMarker(latLng){
        console.log(latLng);
        let marker6=new google.maps.Marker({
            map:map,
            position:latLng,
            draggable:true
        });
    
    }
       
  }