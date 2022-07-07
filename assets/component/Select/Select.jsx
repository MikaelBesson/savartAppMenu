import "./Select.scss";
import { useRef, useState, Children, cloneElement, useEffect } from "react";

export const Select = ({ children, title }) => {
  const [showOptions, setShowOptions] = useState(false);
  const [selectedOptions, setSelectedOptions] = useState([]);
  const parentRef = useRef();
  const optionsRef = useRef();

  useEffect(() => {
    /**
     * Alert if clicked on outside of element
     */
    function handleClickOutside(event) {
      // Checking if not parent ref contains event.
      if (parentRef.current && !parentRef.current.contains(event.target)) {
        // Checking now if options contains event.
        let has = false;
        Array.from(optionsRef.current.children).forEach((child) => {
          if (child.contains(event.target)) {
            has = true;
          }
        });
        // Handling buttons.
        if (event.target.tagName === "BUTTON") {
          has = true;
        }
        if (!has) {
          setShowOptions(false);
        }
      }
    }
    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, [parentRef, optionsRef]);

  const handleSelectionChange = (optionKey, isSelected) => {
    let current = selectedOptions;
    if (isSelected && !current.includes(optionKey)) {
      current.push(optionKey);
    } else if (current.includes(optionKey)) {
      current.splice(current.indexOf(optionKey), 1);
    }

    setSelectedOptions(current);
    console.log(current);
  };

  return (
    <div id="mika-select">
      <div
        ref={parentRef}
        className="container custom-select"
        onClick={() => {
          setShowOptions(!showOptions);
        }}
      >
        {title}
        <span className="arrow">{showOptions ? "▲" : "▼"}</span>
      </div>
      {showOptions && (
        <div
          ref={optionsRef}
          className="custom-select options-container"
          style={{
            //left: parentRef.current.getBoundingClientRect().left,
            left: 0,
            top: "1rem",
            //parentRef.current.getBoundingClientRect().top +
            //parentRef.current.getBoundingClientRect().height +
            //"px",
          }}
        >
          {Children.map(children, (child, index) =>
            cloneElement(child, {
              onChange: handleSelectionChange,
              identifier: index,
            })
          )}
        </div>
      )}
    </div>
  );
};
