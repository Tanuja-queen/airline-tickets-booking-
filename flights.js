// flights.js

// Select the Add Flight button and modal
const addFlightBtn = document.getElementById('addFlightBtn');
const flightModal = new bootstrap.Modal(document.getElementById('flightModal'));

// Add Flight button functionality
addFlightBtn.addEventListener('click', () => {
    document.getElementById('flightModalLabel').textContent = 'Add Flight';
    flightModal.show();
});
