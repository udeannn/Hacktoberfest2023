import React from "react";
import Page from "layout/page";

const teckList: String[] = [
  "ReactJs",
  "NextJS",
  "Angular2x",
  "NodeJS",
  "React Native",
  "MongoDB",
  "MySQL",
  "Amazon Web Services (AWS)",
  "HTML5/CSS3",
  "SCSS/SASS",
  "JavaScript (ESx)/Typescript",
  "Styled-Components",
  "Git/Webpack/Babel",
  "Web Extensions",
];

export default function Teck({}) {
  return (
    <Page>
      <div className="flex flex-col md:justify-center items-center bg-[#f6f6f7] drop-shadow-xl">
        <div className="mt-5 md:my-10 text-center">
          <h2 className="text-primary-text font-bold text-2xl md:text-4xl md:mb-5 w-[50%] mx-auto">
            Here are a few technologies I’ve been working with✨
          </h2>

          <div className="text-left m-[70px]">
            <ul className="flex flex-wrap justify-center">
              {teckList.map((_teck, idx) => {
                return (
                  <li
                    key={idx}
                    className={`text-secondary-text text-[16px] py-[5px] px-[10px] bg-[#e3e3e5] mb-[10px] rounded-md  ${
                      teckList.length - 1 === idx ? "" : "mr-3"
                    }`}
                  >
                    <span>⚬</span>
                    <span className="ml-[10px]">{_teck}</span>
                  </li>
                );
              })}
            </ul>
          </div>
        </div>
      </div>
    </Page>
  );
}
