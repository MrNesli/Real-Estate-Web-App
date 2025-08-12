const reserveBtns = document.querySelectorAll('.reserve-btn');

initReserveButtonsClickEvent();

function initReserveButtonsClickEvent() {
    reserveBtns.forEach((button) => {
        button.addEventListener('click', onReserveButtonClick);
    });
}

function onReserveButtonClick() {
    const propertyId = this.getAttribute('data-property-id');
    const modal = document.querySelector(`.reservation-modal[data-property-id="${propertyId}"]`);
    if (!modal) {
        console.log(`Modal with property id ${propertyId} wasn't found`);
        return;
    }

    modal.classList.toggle('hidden');
}
