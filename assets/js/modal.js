function abrirModal(card) {
  const modal = document.getElementById('modalReserva');

  document.getElementById('modalCabania').textContent = "Cabaña: " + card.dataset.idCabania;
  document.getElementById('modalNombre').textContent = "Nombre: " + card.dataset.nombre;
  document.getElementById('modalApellido').textContent = "Apellido: " + card.dataset.apellido;
  document.getElementById('modalDNI').textContent = "DNI: " + card.dataset.dni;
  // document.getElementById('modalId').textContent = "ID Reserva: " + card.dataset.idReserva;
  document.getElementById('modalAdultos').textContent = "Adultos: " + card.dataset.adultos;
  document.getElementById('modalNinios').textContent = "Niños: " + card.dataset.ninios;
  document.getElementById('modalBebes').textContent = "Bebés: " + card.dataset.bebes;
  document.getElementById('modalIngreso').textContent = "Ingreso: " + card.dataset.llegada;
  document.getElementById('modalEgreso').textContent = "Egreso: " + card.dataset.salida;
  document.getElementById('modalNoches').textContent = "Noches: " + card.dataset.noches;
  document.getElementById('modalNotas').textContent = "Notas: " + card.dataset.notas;
  // document.getElementById('modalLate').textContent = "Late Checkout: " + card.dataset.lateCheck;
  document.getElementById('modalValor').textContent = "Valor: $ " + card.dataset.valor;

  modal.style.display = 'block';

  // cerrar
  const closeBtn = modal.querySelector('.close');
  closeBtn.onclick = () => modal.style.display = 'none';
  modal.addEventListener('click', (e) => {
    if (e.target === modal) modal.style.display = 'none';
  })

  //cierra solo el modal
  const modalContent = modal.querySelector('.modal-content');
  modalContent.addEventListener('click', (e) => {
    e.stopPropagation(); // evita que el click cierre el modal
  });
};

