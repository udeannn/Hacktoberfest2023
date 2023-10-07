export class RenderUI {
  constructor() {
    this.container = document.querySelector('.container');
  }

  dataWeather(location, currWeather, icon, tempWeather, isDay) {
    if (isDay) {
      this.updateUi('Day');
      return `<div class="card">
          <img src="src/img/day.svg" alt="day" />
          <div class="weather-container">
            <div class="icons">
              <img src="src/img/icons/${icon}.svg" alt=" " />
            </div>
            <div class="info">
            <h2>${location}</h2>
            <h4>${currWeather}</h4>
            <h1>${tempWeather} °C</h1>
            </div>
          </div>
        </div>`;
    } else {
      this.updateUi('night');
      return `<div class="card">
                    <img src="src/img/night.svg" alt="night" />
                    <div class="weather-container">
                      <div class="icons">
                        <img src="src/img/icons/${icon}.svg" alt=" " />
                      </div>
                      <div class="info night">
                      <h2>${location}</h2>
                      <h4>${currWeather}</h4>
                      <h1>${tempWeather} °C</h1>
                      </div>
                    </div>
                  </div>`;
    }
  }

  updateUi(time) {
    if (time == 'Day') {
      this.container.classList.remove('night-mode');
    } else {
      this.container.classList.add('night-mode');
    }
  }
}
