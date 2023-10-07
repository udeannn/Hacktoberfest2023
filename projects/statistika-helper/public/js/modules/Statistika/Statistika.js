import { NoConstructor, TidakAdaAngka } from "../errors/custom.error.js";
import { isEmpty, getKeyByValue } from "../utilities/utilities.js";

export class Statistika {
  #privateData;

  // Constructor
  constructor(data) {
    try {
      if (data === undefined) {
        throw new NoConstructor("Constructor Can't be Omitted");
      } else if (isEmpty(data)) {
        throw new TidakAdaAngka("Setidaknya Masukkan 1 Angka");
      } else {
        this.#privateData = [...data].sort((a, b) => a - b);
      }
    } catch (kesalahan) {
      console.error(kesalahan.stack);
      alert(`${kesalahan.name}: ${kesalahan.message}`);
    }
  }

  // Tampilkan Data yang udah terurut secara Ascending
  sortAscending() {
    return this.#privateData;
  }

  // Tampilkan Data yang udah terurut secara Descending
  sortDescending() {
    return [...this.#privateData].sort((a, b) => b - a);
  }

  // Tampilkan Nilai Terbesar
  maxValue() {
    return Math.max(...this.#privateData);
  }

  // Tampilkan Nilai Terkecil
  minValue() {
    return Math.min(...this.#privateData);
  }

  // Tampilkan Nilai Rata-Rata
  // sama aja kayak
  /* 
    let sum = 0;

    for (let i = 0; i < this.#privateData.length; i++) {
      sum += #privateData[i];
    }
  */
  average() {
    const banyakData = this.#privateData.length;

    return (
      this.#privateData.reduce((total, value) => {
        return total + value;
      }, 0) / banyakData
    );
  }

  // Tampilkan Nilai Tengah
  median() {
    const banyakData = this.#privateData.length;

    // kalo data-nya ganjil, berarti pas ditengah
    if (banyakData % 2 == 1) {
      return this.#privateData[Math.floor(banyakData / 2)];
    } else {
      return (this.#privateData[Math.floor(banyakData / 2) - 1] + this.#privateData[Math.floor(banyakData / 2)]) / 2;
    }
  }

  // Tampilkan Nilai Modus
  /*
   * Credit & Reference
   * https://stackoverflow.com/questions/1053843/get-the-element-with-the-highest-occurrence-in-an-array
   * https://stackoverflow.com/questions/9907419/how-to-get-a-key-in-a-javascript-object-by-its-value
   */
  modus() {
    const map = {};

    this.#privateData.forEach((value) => {
      if (map[value] == null) {
        map[value] = 1;
      } else {
        map[value]++;
      }
    });

    return new Set(Object.values(map)).size > 1 ? getKeyByValue(map, Math.max(...Object.values(map))) : "-";
  }
}
