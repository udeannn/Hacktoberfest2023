const tempRandomAngka = () => {
    const min = 20;
    const max = 40;

    const random = Math.floor(Math.random() * (max - min + 1)) + min;
    return random;
};

const weathertemp = document.getElementById('weather-temp');
weathertemp.innerText = tempRandomAngka() + '°C';

for (let a = 1; a <= 4; a++) {
    const dayTemp = document.getElementById(`day-temp-${a}`);
    dayTemp.innerText = tempRandomAngka() + '°C';
}

const humidRandomAngka = () => {
    const min = 1;
    const max = 20;

    const randomize = Math.floor(Math.random() * (max - min + 1)) + min;
    return randomize;
};

const wind = document.getElementById('value-3');
wind.innerText = humidRandomAngka() + ' km/h';

const dayHumid = document.getElementById('value-1');
const dayHumid2 = document.getElementById('value-2');

dayHumid.innerText = humidRandomAngka() + ' ' + '%';
dayHumid2.innerText = humidRandomAngka() + ' ' + '%';

const getHari = () => {
    const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const hariIni = new Date().getDay();
    return namaHari[hariIni];
};

const dateDayName = document.getElementById('date-dayname');
dateDayName.innerText = getHari();

const getTanggal = () => {
    const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

    const tanggal = new Date();
    const tanggalStr = tanggal.getDate();
    const bulanStr = namaBulan[tanggal.getMonth()];
    const tahunStr = tanggal.getFullYear();

    return `${tanggalStr} ${bulanStr} ${tahunStr}`;
};

const dateDay = document.getElementById('date-day');
dateDay.innerText = getTanggal();

const getHariEsok = (hariDepan) => {
    const namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    const hariIni = new Date().getDay();
    const hariEsok = (hariIni + hariDepan) % 7;
    return namaHari[hariEsok];
};

for (let i = 1; i <= 7; i++) {
    const hariElement = document.getElementById(`day-name-${i}`);
    if (hariElement) {
        hariElement.innerText = getHariEsok(i);
    }
}

feather.replace();
