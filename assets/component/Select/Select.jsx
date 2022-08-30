import "./Select.scss";
import { useRef, useState, Children, cloneElement, useEffect } from "react";

export const Select = ({ children, title, moment, day }) => {
  const [showOptions, setShowOptions] = useState(false);
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
        if (optionsRef.current.children) {
          Array.from(optionsRef.current.children).forEach((child) => {
            if (child.contains(event.target)) {
              has = true;
            }
          });
        }
        // Handling buttons.
        if (event.target.tagName === "BUTTON") {
          has = true;
        }
        // Si on clic en dehors du composant, on quitte et on retire les éléments choisis.
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

  /**
   * Envoi vers le serveur.
   * @param optionKey
   * @param isSelected
   */
  const handleSelectionChange = (optionKey, isSelected) => {
    fetch("/api/user-recipe/handle", {
      method: "POST",
      body: JSON.stringify({
        recipe: optionKey,
        selected: isSelected,
        moment: moment,
        day: day,
      }),
    })
      .then((result) => result.json())
      .then((result) => console.log(result.message));
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
