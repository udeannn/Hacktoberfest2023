import { AppProps } from "next/app";
import Head from "next/head";
import "../scss/main.scss";

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <>
      <Head>
        <title>Usman Ghani - Portfolio</title>
        <meta
          property="og:title"
          content="Usman Ghani - Portfolio"
          key="title"
        />
        <meta
          name="description"
          content="Hi folks, My name is Muhammad Usman Ghani i live in Pakistan, Karachi city of where you
          find all kind of good food. For past 3 years i`ve been working as a Sofware Engineer and
          building good things around Javascript."
        />
        <link rel="icon" href="logo.jpg" className="rounded-full"></link>
      </Head>
      <Component {...pageProps} />
    </>
  );
}

export default MyApp;
