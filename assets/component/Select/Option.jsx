import "./Select.scss";
import { useState } from "react";

export const Option = ({
  children,
  identifier,
  img,
  value,
  defaultSelected,
  onChange = () => {},
}) => {
  const [selected, setSelected] = useState(defaultSelected);

  const handleChange = () => {
    setSelected(!selected);
    onChange(value, !selected);
  };

  return (
    <div className="custom-select-option" onClick={() => handleChange()}>
      <div className="multi-select-label-container">
        <img src={img} alt="label" />
        <span>{children}</span>
      </div>
      <input
        readOnly
        type="checkbox"
        id={identifier}
        checked={selected}
        style={{
          transform: "scale(2)",
        }}
      />
    </div>
  );
};
