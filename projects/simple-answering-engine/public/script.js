function search() {
    const searchInput = document.getElementById('searchInput');
    const query = searchInput.value.trim();
    if (!query) {
      alert("Please enter a search query.");
      return;
    }
  
    fetch(`/search?text=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(data => displayResults(data))
      .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while fetching data from the server.");
      });
  }
  
  function displayResults(results) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';
  
    if (results.length === 0) {
      resultsDiv.innerHTML = '<p>No results found.</p>';
      return;
    }
  
    const result = results[0];
    const question = result.question;
  
    const content = question.content;
    const answerContent = question.answer.content;
  
    resultsDiv.innerHTML = `
      <h2>${content}</h2>
      <p>${answerContent}</p>
    `;
  }
  