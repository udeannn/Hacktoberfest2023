const wibTime = document.querySelector('#WIB');
const witaTime = document.querySelector('#WITA');
const witTime = document.querySelector('#WIT');
const date = document.querySelector('#date');

function getTime() {
  const currentDate = new Date().toLocaleDateString('id-ID', {
    dateStyle: 'full',
  });
  const time = new Date();
  const wib = time
    .toLocaleString('id-ID', { timeZone: 'Asia/Jakarta', timeStyle: 'medium' })
    .replaceAll('.', ':');
  const wita = time
    .toLocaleString('id-ID', { timeZone: 'Asia/Makassar', timeStyle: 'medium' })
    .replaceAll('.', ':');
  const wit = time
    .toLocaleString('id-ID', { timeZone: 'Asia/Jayapura', timeStyle: 'medium' })
    .replaceAll('.', ':');

  wibTime.innerHTML = wib;
  witaTime.innerHTML = wita;
  witTime.innerHTML = wit;
  date.innerHTML = currentDate;
}

getTime();

setInterval(getTime, 1000);
