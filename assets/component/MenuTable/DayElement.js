import { ShowModalMenu } from "../Modal/ModalMenuSelect";
import Swal from "sweetalert2";
/* @see https://github.com/sweetalert2/sweetalert2-react-content */
import withReactContent from "sweetalert2-react-content";

export const DayElement = function ({ dayName }) {
  const ReactSwal = withReactContent(Swal);

  const showCategories = () => {
    ReactSwal.fire({
      title: "<strong>Vos envies pour </strong>" + dayName,
      html: <ShowModalMenu />,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: "OK",
      cancelButtonText: "Annuler",
    });
  };

  return (
    <td onClick={showCategories} className={"box-select"}>
      Cliquez
    </td>
  );
};
