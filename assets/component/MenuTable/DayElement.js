import { ShowModalMenu } from "../Modal/ModalMenuSelect";
import Swal from "sweetalert2";
/* @see https://github.com/sweetalert2/sweetalert2-react-content */
import withReactContent from "sweetalert2-react-content";

export const DayElement = function ({ day, moment }) {
  const ReactSwal = withReactContent(Swal);

  const showCategories = () => {
    ReactSwal.fire({
      title: "<strong>Vos envies pour </strong><br>" + day + " " + moment,
      html: <ShowModalMenu moment={moment} day={day} />,
      focusConfirm: false,
      confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
    });
  };

  return (
    <td onClick={() => showCategories()} className={"box-select"}>
      Cliquez
    </td>
  );
};
