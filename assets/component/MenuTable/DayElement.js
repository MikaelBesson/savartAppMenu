import React from "react";

export const DayElement = function({ dayName, type }) {

    /**
     * Handle selection button click to select menu.
     */
    function selectionButtonClicked() {
        console.log("Jour: ", dayName);
        console.log("Type: ", type );
    }

    return (
        <td className={"box-select"}>
            <button onClick={() => selectionButtonClicked()} className="select">Selection</button>
        </td>
    );
}