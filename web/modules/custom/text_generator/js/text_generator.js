
// Weather API sample javascript code
// Requires: jQuery and crypto-js (v3.1.9)
//

(function ($, Drupal) {

  'use strict';

  /**
   * Registers behaviours related to text_generator.
   */
  Drupal.behaviors.text_generator = {
    attach: function (context) {

      var url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
      var method = 'GET';
      var app_id = 'oC241L44';
      var consumer_key = 'dj0yJmk9TjNKYzBuNlpxbzFOJmQ9WVdrOWIwTXlOREZNTkRRbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PWMz';
      var consumer_secret = 'ef8daa3d69c3977a9f419b9df4d6cb0949714417';
      var concat = '&';
      var query = { 'location': 'Puntarenas', 'format': 'json' };
      var oauth = {
        'oauth_consumer_key': consumer_key,
        'oauth_nonce': Math.random().toString(36).substring(2),
        'oauth_signature_method': 'HMAC-SHA1',
        'oauth_timestamp': parseInt(new Date().getTime() / 1000).toString(),
        'oauth_version': '1.0'
      };

      var merged = {};
      $.extend(merged, query, oauth);
      // Note the sorting here is required
      var merged_arr = Object.keys(merged).sort().map(function (k) {
        return [k + '=' + encodeURIComponent(merged[k])];
      });
      var signature_base_str = method
        + concat + encodeURIComponent(url)
        + concat + encodeURIComponent(merged_arr.join(concat));

      var composite_key = encodeURIComponent(consumer_secret) + concat;
      var hash = CryptoJS.HmacSHA1(signature_base_str, composite_key);
      var signature = hash.toString(CryptoJS.enc.Base64);

      oauth['oauth_signature'] = signature;
      var auth_header = 'OAuth ' + Object.keys(oauth).map(function (k) {
        return [k + '="' + oauth[k] + '"'];
      }).join(',');

      $.ajax({
        url: url + '?' + $.param(query),
        headers: {
          'Authorization': auth_header,
          'X-Yahoo-App-Id': app_id
        },
        method: 'GET',
        success: function (data) {
          //console.log("la longitud "+data.location.lat+"\nla latitud"+ data.location.long);
          swal("The temperature is " + data.current_observation.condition.temperature + " °F", "This is important to know", "success");
          //window.alert("The temperature is " + data.current_observation.condition.temperature + " °F");
          //echo $return_data->location->lat;

        }

      });

    }
  };


}(jQuery, Drupal));
