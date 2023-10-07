class NoConstructor extends Error {
  constructor(message) {
    super(message);
    this.name = "No Constructor";
  }
}
class TidakAdaAngka extends Error {
  constructor(message) {
    super(message);
    this.name = "Tidak Ada Angka";
  }
}

export { NoConstructor, TidakAdaAngka };
