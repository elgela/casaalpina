function abrirModal(card) {
  const modal = document.getElementById('modalReserva');

  document.getElementById('modalCabania').textContent = "Cabaña: " + card.dataset.idCabania;
  document.getElementById('modalNombre').textContent = "Nombre: " + card.dataset.nombre;
  document.getElementById('modalApellido').textContent = "Apellido: " + card.dataset.apellido;
  document.getElementById('modalDNI').textContent = "DNI: " + card.dataset.dni;
  // document.getElementById('modalId').textContent = "ID Reserva: " + card.dataset.idReserva;
  document.getElementById('modalAdultos').textContent = "Adultos: " + card.dataset.adultos;
  document.getElementById('modalMenores').textContent = "Menores: " + card.dataset.menores;
  document.getElementById('modalBebes').textContent = "Bebés: " + card.dataset.bebes;
  document.getElementById('modalIngreso').textContent = "Ingreso: " + formatoLatino(card.dataset.fechaIngreso);
  document.getElementById('modalEgreso').textContent = "Egreso: " + formatoLatino(card.dataset.fechaEgreso);
  document.getElementById('modalValor').textContent = "Valor: $" + card.dataset.valor;

  modal.style.display = 'block';

  // cerrar
  const closeBtn = modal.querySelector('.close');
  closeBtn.onclick = () => modal.style.display = 'none';
  window.onclick = (e) => { 
    if (e.target === modal) modal.style.display = 'none'; 
  };
}
