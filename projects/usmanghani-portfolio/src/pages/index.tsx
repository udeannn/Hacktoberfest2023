import React from "react";
import Header from "layout/header";
import Footer from "layout/footer";
import Hero from "container/hero";
import About from "container/about";
import Teck from "container/teck";
import Experience from "container/experience";
import Work from "container/work";

interface Props {}

export default function Page({}: Props) {
  return (
    <div className="bg-main">
      <Header />

      <main>
        <Hero />
        <About />
        <Work />
        <Teck />
        <Experience />
      </main>

      <Footer />
    </div>
  );
}
