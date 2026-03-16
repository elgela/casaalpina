function abrirModal(card) {
  const modal = document.getElementById('modalReserva');

  let opciones =  {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hourCycle: 'h23' // fuerza formato 24 horas
  };

  document.getElementById('modalCabania').textContent = "Cabaña: " + card.dataset.idCabania;
  document.getElementById('modalNombre').textContent = "Nombre: " + card.dataset.nombre;
  document.getElementById('modalApellido').textContent = "Apellido: " + card.dataset.apellido;
  document.getElementById('modalDNI').textContent = "DNI: " + card.dataset.dni;
  document.getElementById('modalAdultos').textContent = "Adultos: " + card.dataset.adultos;
  document.getElementById('modalNinios').textContent = "Niños: " + card.dataset.ninios;
  document.getElementById('modalBebes').textContent = "Bebés: " + card.dataset.bebes;

  // Convertir string a objeto Date
  let llegada = new Date(card.dataset.llegada);
  let salida  = new Date(card.dataset.salida);

  // Formatear en formato argentino DD/MM/YYYY HH:MM
  document.getElementById('modalIngreso').textContent =
      "Ingreso: " + llegada.toLocaleDateString('es-AR', opciones);
  document.getElementById('modalEgreso').textContent =
      "Egreso: " + salida.toLocaleDateString('es-AR', opciones);

  document.getElementById('modalNoches').textContent = "Noches: " + card.dataset.noches;
  document.getElementById('modalNotas').textContent = "Notas: " + card.dataset.notas;
  const valor = parseFloat(card.dataset.valor);
  const valorFormateado = valor.toLocaleString('es-AR', { minimumFractionDigits: 2 });
  document.getElementById('modalValor').textContent = "Valor: $" + valorFormateado;

  modal.style.display = "block";

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

