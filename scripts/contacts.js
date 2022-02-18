function initMap() {
    graciousGarments = {lat: 21.01937000000007, lng: 105.80871845823378};
    map = new google.maps.Map(document.getElementById('gmaps'), {
        zoom: 15,
        center: graciousGarments,
    });
    marker = new google.maps.Marker({
        position: graciousGarments,
        map: map,
    });
}