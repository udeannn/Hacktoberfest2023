import express from "express";
const app = express();

import mongoose from "mongoose";

import { nanoid } from 'nanoid';
import cors from "cors";
import bodyParser from "body-parser";
require('dotenv').config();


app.set("view engine", "ejs");

mongoose.connect("process.env.MONGODB_URI ", {
  useNewUrlParser: true,
  useUnifiedTopology: true
});
const UrlSchema = new mongoose.Schema({
  longUrl: String,
  shortKey: String
});
const Url = mongoose.model('Url', UrlSchema);

app.use(express.json());
app.use(cors()); 



app.post('/shorten', async (req, res) => {
  // Code for creating short URLs...
});


app.get("/", function(req,res){
  res.render("index.ejs");
});

app.post("/",async(req,res)=>{

 const {longUrl} =  req.body;
 const shortKey = nanoid(7);
 await Url.create({ longUrl: longUrl, shortKey });
 const shortUrl = `http://localhost:400/${shortKey}`;
 res.json({ shortUrl });

});

app.get('/:shortKey', async (req, res) => {
  const {shortKey}   = req.params;
  console.log('Short Key:', shortKey);
  const url = await Url.findOne({ shortKey });

  if (url) {
    res.redirect(url.longUrl);
  } else {
    res.status(404).json({ error: 'URL not found' });
  }
});
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Internal Server Error' });
});


  app.listen("400", (req,res)=>{
    console.log("Server is running on port 400");
   
    
});