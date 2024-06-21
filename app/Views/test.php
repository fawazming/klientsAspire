<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google Reviews</title>
  <style>
    .review {
      border: 1px solid #ddd;
      padding: 10px;
      margin: 10px;
    }
  </style>
</head>
<body>
  <h1>Google Business Reviews</h1>
  <div id="reviews"></div>

  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA90gVGCee7k4GjZN_B9ykrxZj6e9KSilEk&libraries=places AIzaSyBnJ7n3CgdGoTeydioB6U2ZxYUZJNya_m0"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnJ7n3CgdGoTeydioB6U2ZxYUZJNya_m0&libraries=places"></script>
  <!-- <script src="reviews.js"></script> -->
  <script>
  	function initialize() {
  const placeId = 'ChIJ95qPkLXbOxAR9HYI1_CXrUs';
  const request = {
    placeId: placeId,
    fields: ['name', 'rating', 'reviews']
  };

  const service = new google.maps.places.PlacesService(document.createElement('div'));
  service.getDetails(request, (place, status) => {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      displayReviews(place.reviews);
    }
  });
}

function displayReviews(reviews) {
  const reviewsContainer = document.getElementById('reviews');
  reviews.forEach(review => {
    const reviewDiv = document.createElement('div');
    reviewDiv.className = 'review';
    reviewDiv.innerHTML = `
      <h3>${review.author_name}</h3>
      <p>Rating: ${review.rating}</p>
      <p>${review.text}</p>
    `;
    reviewsContainer.appendChild(reviewDiv);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

  </script>
</body>
</html>
