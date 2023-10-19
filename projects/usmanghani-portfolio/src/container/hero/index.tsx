import React from "react";
import Page from "layout/page";
import MediaLinks from "components/media-links";

interface IMedia {
  href: any;
  text: String;
}

const media: IMedia[] = [
  { href: "mailto:usmanghanidev@gmail.com", text: "Email Me" },
  { href: "https://github.com/usmanghanidev", text: "Github" },
  { href: "https://twitter.com/usmanghanidev", text: "Twitter" },
  { href: "https://www.hackerrank.com/usmanghanidev", text: "Hacker Rank" },
  {
    href: "https://www.linkedin.com/in/muhammad-usman-ghani-92a97b195/",
    text: "Linkdin",
  },
];

export default function Index({}) {
  return (
    <Page>
      <div className="flex flex-col md:justify-center items-center p-4 pt-20 md:p-0">
        <div
          className="h-32 w-32 md:h-40 md:w-40 bg-no-repeat bg-cover bg-top rounded-full"
          style={{ backgroundImage: "url('/me.jpg')" }}
        ></div>

        <div className="mt-5 md:mt-10 text-center">
          <p className="text-primary-text font-thin text-2xl md:text-4xl  md:mb-2">
            Hi, there👋
          </p>

          <h1 className="text-2xl md:text-6xl text-primary-text font-bold  md:mb-2">
            Muhammad Usman Ghani
          </h1>
        </div>

        <div className="md:mt-8 text-center">
          {media.map((_m, idx) => (
            <MediaLinks key={idx} href={_m.href}>
              {_m.text}
            </MediaLinks>
          ))}
        </div>
      </div>
    </Page>
  );
}
