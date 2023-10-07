/**
 * @param {String} str value yang ada di Textarea
 * @returns {Array} Array yang isinya String
 */
const formatInput = (str) => str.replace(/\W+/g, " ").split(" ");

/**
 * @param {Array} arr Array
 * @returns {Array} Array yang isinya hanya String Angka
 */
const filterInput = (arr) => arr.filter((value) => Boolean(parseInt(value)));

/**
 * @param {Array} arr yang mau di-cek
 * @returns {Boolean} True / False
 */
const isEmpty = (arr) => arr.length <= 0;

/**
 * @param {Object} object source object
 * @param {Number} value yang mau dicari
 * @returns {Number} value
 */
const getKeyByValue = (object, value) => {
  return Object.keys(object).find((key) => object[key] == value);
};

/**
 * Bikin Dataset buat chartjs
 * @param {Array} array sumber data
 * @returns {Array} Array of Object
 */
const createDataset = (array) => {
  const uniqueData = [...new Set(array)].sort((a, b) => a - b);

  const result = uniqueData.map((value) => {
    return {
      angka: value,
      kejadian: array.filter((angka) => angka == value).length,
    };
  });

  return result;
};

export { formatInput, filterInput, isEmpty, getKeyByValue, createDataset };
