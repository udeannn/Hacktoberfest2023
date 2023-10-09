import React from "react";

interface Props {
  sm: boolean;
}

const RasumeBtn: React.FC<Props> = ({ sm }) => {
  return (
    <button
      className={`bg-brand hover:bg-brand-hover transition text-white py-2 px-4 font-bold rounded-full ${
        sm ? "hidden md:block" : "block md:hidden"
      }`}
    >
      <a href="/usmanghani.pdf" download="muhammad-usman-ghani-resume">
        Download Resume
      </a>
    </button>
  );
};

export default RasumeBtn;
