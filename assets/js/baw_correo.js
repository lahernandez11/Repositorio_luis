$(document).ready(function() {
  $('.typeahead').typeahead({
    name: 'countries',
    remote: base_url+'baw/administrar/carga_usuario?query=%QUERY',
    limit: 10
  });
  
});
