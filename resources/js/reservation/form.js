const modals = document.querySelectorAll('.reservation-modal');

handleReservationDateInputs();
handleReservationFormsOutsideClick();

function handleReservationFormsOutsideClick() {
    modals.forEach((modal) => {
        const reservationForm = modal.querySelector('.reservation-form');
        modal.addEventListener('click', (event) => {
            if (!reservationForm.contains(event.target)) {
                modal.classList.toggle('hidden');
            }
        });
    });
}

function handleReservationDateInputs() {
    modals.forEach((modal) => {
        const reserveStartDateInput = modal.querySelector('.reserve-start-date');
        const reserveEndDateInput = modal.querySelector('.reserve-end-date');
        reserveStartDateInput.addEventListener('change', () => {
            reserveEndDateInput.min = reserveStartDateInput.value;
        });

        reserveEndDateInput.addEventListener('change', () => {
            reserveStartDateInput.max = reserveEndDateInput.value;
        });
    })
}

