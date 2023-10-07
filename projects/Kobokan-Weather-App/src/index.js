import { Weather } from './utils/weather.services.js';
import { RenderUI } from './utils/renderUi.services.js';

const weather = new Weather();
const renderUi = new RenderUI();
const searchButton = document.querySelector('.search-button');

searchButton.addEventListener('click', async () => {
  const container = document.querySelector('.card-container');
  const inputKeyword = document.querySelector('.input-keyword').value;
  const { Key, EnglishName } = await weather.getLocation(inputKeyword);
  const { WeatherText, IsDayTime, temp, WeatherIcon } = await weather.getWeatherCondition(Key);
  container.innerHTML = renderUi.dataWeather(EnglishName, WeatherText, WeatherIcon, temp, IsDayTime);
});

const loader = () => {
  document.querySelector('.loader-container').classList.add('fade-out');
};

const fadeOut = () => {
  setInterval(loader, 2500);
};

window.onload = fadeOut;
