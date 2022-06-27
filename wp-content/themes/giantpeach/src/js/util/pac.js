// util/pac

function Pac(el) {
    return this.initAutocomplete(el);
}

Pac.prototype.initAutocomplete = function(el) {
    return new google.maps.places.Autocomplete( el );
}

export default Pac;
