import React from "react";
import MediaLinks from "components/media-links";

const projects = [
  {
    name: "Brand overflow",
    link: "https://www.brandoverflow.com/",
    img: "/brandoverflow.png",
  },

  {
    name: "Topicmojo",
    link: "https://topicmojo.com/",
    img: "/topicnoj.png",
  },
  {
    name: "Mailwarm",
    link: "https://mailwarm.io/",
    img: "/mailwarm.png",
  },
];

export default function Index({}) {
  return (
    <div className="flex flex-col md:justify-center items-center bg-[#f6f6f7] drop-shadow-xl">
      <div className="mt-5 md:my-10 text-center">
        <h2 className="text-primary-text font-bold text-2xl md:text-4xl md:mb-5">
          My Work 👨‍💻
        </h2>

        <div className="flex items-start m-[70px]">
          {projects.map((el, idx) => {
            return (
              <div
                key={idx}
                className={`max-w-sm rounded shadow-lg hover:shadow-xl transition ${
                  projects.length - 1 !== idx && "mr-10"
                }`}
              >
                <MediaLinks href={el.link}>
                  <img className="w-full" src={el.img} alt={el.name} />
                  <div className="px-6 py-4">
                    <div className="font-bold text-xl">{el.name}</div>
                  </div>
                </MediaLinks>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
}
