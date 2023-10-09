import React from "react";

interface Props {
  children?: React.ReactNode;
}

export default function Page({ children }: Props) {
  return (
    <section>
      <div className="container mx-auto py-[100px] px-[10px]">{children}</div>
    </section>
  );
}
