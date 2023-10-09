import React from "react";
import Page from "layout/page";
import ExpCard from "components/exp-card";

interface IExperienceWork {
  name: String;
  text: String;
  joinDate: String;
  leftDate: String;
}

const experienceWork: IExperienceWork[] = [
  {
    name: "Speridian Technologies",
    text: "Worked with AWS cloud services such as Lambda funtions, ec2 instace, s3 bucket, API gateway and cloudformation. Worked on server-side web applications using Node.js and was involved in the Construction of UI using, ReactJS, NextJS, Angular 8. Developed Single Page Web Application with React.js, Redux, Express.js, Node.js, REST API, and MongoDB. Used Mongoose to write CRUD operations for retrieving and updating data. Used Postman to test API and used GIT as a version control tool. Worked with MERN stack for developing applications. Architect, Design and develop front-end applications. Translate wireframes into functional requirements, and write well-abstracted, reusable, high- performance code for UI components.",
    joinDate: "Aug, 2022",
    leftDate: "Prasent",
  },
  {
    name: "Get Licensed",
    text: "Write well-abstracted, reusable, high-performance code for UI and functional components in NextJS as sprint requirement. Ensuring that website design, layout, and coding is optimized for search. Develop application with NextJS. Restful API integraion in NextJS. Working with the web designer to ensure consistent standards of SEO",
    joinDate: "Jun, 2022 ",
    leftDate: "Aug, 2022",
  },
  {
    name: "Massive Venture",
    text: "Worked on server-side web applications using Node.js and was involved in the Construction of UI using, ReactJS, NextJS, Tailwindcss and JavaScript. Developed Single Page Web Application with React.js, Redux, Express.js, Node.js, REST API, and MongoDB. Used Mongoose to write CRUD operations for retrieving and updating data. Used Postman to test API and used GIT as a version control tool. Worked with MERN stack for developing applications. Architect, Design and develop front-end applications. Translate wireframes into functional requirements, and write well-abstracted, reusable, high- performance code for UI components. Turn style guides into front-end frameworks and coding standards. Build B2B B2C SaaS Web apps. Build Google Chrome Extension Build Cross-platform mobile apps with React-native. Write code with the best SEO practices so our app can be search by google crawlers. Troubleshooting technical SEO issues for the website",
    joinDate: "Oct, 2020 ",
    leftDate: "Jun, 2022",
  },
  {
    name: "Inapp Solutions",
    text: "uild responsive UI, on React.JS & React Native, API integration Adding firebase, State Management.",
    joinDate: "Feb, 2020",
    leftDate: "Oct, 2020",
  },
  {
    name: "Luiteck Pakistan (PVT) Ltd",
    text: "Responsive static webpages, JavaScript functionally for dynamic behaviours Created Models and Views in dot .net",
    joinDate: "Aug, 2019",
    leftDate: "Feb, 2020",
  },
];

export default function Experience({}) {
  return (
    <Page>
      <div className="flex flex-col md:justify-center items-center">
        <div className="mt-5 md:mt-10 text-center">
          <h2 className="text-primary-text font-bold text-2xl md:text-4xl md:mb-5">
            Where I’ve Worked 🤙
          </h2>
        </div>
        <div className="my-[20px]"></div>
        {experienceWork.map((_exp, idx) => (
          <ExpCard key={idx} data={_exp} />
        ))}
      </div>
    </Page>
  );
}
