import React from "react";

interface IExperienceWork {
  name: String;
  text: String;
  joinDate: String;
  leftDate: String;
}

interface Props {
  data: IExperienceWork;
}

const RasumeBtn: React.FC<Props> = ({ data }) => {
  return (
    <div className="w-[50%] mx-auto mb-[35px] drop-shadow-md">
      <div className="rounded bg-[#f6f6f7] px-[20px] py-[10px]">
        <div className="flex items-center justify-between">
          <h3 className="text-primary-text font-semibold text-[18px]">
            {data.name}
          </h3>
          <p className="text-secondary-text text-[14px]">
            <span>{data.joinDate}</span> -{""}
            <span>{data.leftDate}</span>
          </p>
        </div>

        <div className="mt-[10px]">
          <p className="text-secondary-text text-[14px]">{data.text}</p>
        </div>
      </div>
    </div>
  );
};

export default RasumeBtn;
