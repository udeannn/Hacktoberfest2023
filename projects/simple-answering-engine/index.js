const express = require('express');
const axios = require('axios');

const app = express();
const port = 3000;

const url = "https://srv-unified-search.external.search-systems-production.z-dn.net/api/v1/id/search";
const headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0",
    "Accept": "*/*",
    "Accept-Language": "id,en-US;q=0.7,en;q=0.3",
    "x-api-key": "22df2c14-f58b-4603-abf2-788ba76862a0",
    "Content-Type": "text/plain;charset=UTF-8",
    "Sec-Fetch-Dest": "empty",
    "Sec-Fetch-Mode": "cors",
    "Sec-Fetch-Site": "cross-site"
};
const referrer = "https://brainly.co.id/";

// Middleware to serve static files
app.use(express.static('public'));

app.get('/search', (req, res) => {
  const queryText = req.query.text;
  if (!queryText) {
    return res.status(400).json({ error: "Missing 'text' parameter in the query." });
  }

  const data = {
    query: {
      text: queryText
    },
    context: {
      scenario: "",
      supportedTypes: ["question"],
      requestId: ""
    },
    pagination: {
      cursor: null,
      limit: 1
    }
  };

  axios.post(url, data, { headers, referrer })
    .then(response => {
      const { results } = response.data;
      res.json(results);
    })
    .catch(error => {
      console.error("Error:", error);
      res.status(500).json({ error: "An error occurred while fetching data from the API." });
    });
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
