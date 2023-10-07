import { Statistika } from "./modules/Statistika/Statistika.js";
import { filterInput, formatInput } from "./modules/utilities/utilities.js";

const tombolHitung = document.getElementById("hitung");
const tombolReset = document.getElementById("reset");

// Set Tahun Copyright
document.getElementById("tahun").textContent = new Date().getFullYear();

// buat tes
tombolHitung.addEventListener("click", () => {
  const inputTextarea = document.getElementById("input-data").value;

  // Elemen HTML tempat tampilin hasilnya
  const dataYangSudahDiurut = document.getElementById("sorted-data");
  const nilaiTerbesar = document.getElementById("terbesar");
  const nilaiTerkecil = document.getElementById("terkecil");
  const nilaiRataRata = document.getElementById("rata");
  const nilaiMedian = document.getElementById("median");
  const nilaiModus = document.getElementById("modus");
  const grapik = document.getElementById("chart-wrapper");

  // hajar aja langsung sekalian anjg
  const inputData = filterInput(formatInput(inputTextarea));

  // ubah String Angka-nya jadi Angka beneran
  const data = inputData.map((item) => parseInt(item));

  // bikin instance baru
  const app = new Statistika(data);

  // tempelin hasilnya ke HTML
  dataYangSudahDiurut.value = app.sortAscending().join(", ");
  nilaiTerbesar.value = app.maxValue();
  nilaiTerkecil.value = app.minValue();
  nilaiRataRata.value = app.average().toFixed(2);
  nilaiMedian.value = app.median();
  nilaiModus.value = app.modus();

  // munculin grapik-nya
  grapik.classList.remove("hidden");
});

// buat tes
tombolReset.addEventListener("click", () => {
  const inputTextarea = document.getElementById("input-data");

  // Elemen HTML tempat tampilin hasilnya
  const dataYangSudahDiurut = document.getElementById("sorted-data");
  const nilaiTerbesar = document.getElementById("terbesar");
  const nilaiTerkecil = document.getElementById("terkecil");
  const nilaiRataRata = document.getElementById("rata");
  const nilaiMedian = document.getElementById("median");
  const nilaiModus = document.getElementById("modus");
  const grapik = document.getElementById("chart-wrapper");

  // Reset Semua Field
  inputTextarea.value = "";
  dataYangSudahDiurut.value = "";
  nilaiTerbesar.value = "";
  nilaiTerkecil.value = "";
  nilaiRataRata.value = "";
  nilaiMedian.value = "";
  nilaiModus.value = "";

  // sembunyiin grapik-nya
  grapik.classList.add("hidden");
});
