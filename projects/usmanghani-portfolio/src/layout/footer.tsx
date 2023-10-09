import React from "react";
import Link from "next/link";

export default function footer() {
  return (
    <footer className="p-[20px]">
      <div className="container mx-auto text-center px-[10x] transition text-primary-text text-[15px]  hover:text-brand-hover">
        <Link
          href="https://github.com/usmanghanidev"
          target="_blank"
          rel="noreferrer"
          passHref
        >
          <a>&#169; Muhammad Usman Ghani {new Date().getFullYear()}</a>
        </Link>
      </div>
    </footer>
  );
}
