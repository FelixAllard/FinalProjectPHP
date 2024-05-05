
import './Root.css'
import Card from '../components/card/Card'
export default function Root() {
    return (

      
      <>
        <div className="root">
          <h1>React Router Contacts</h1>
          <nav>
            <ul>

              <li key="mnu_0">
                <a href={`/todoList`}>TodoList</a>
              </li>

              <li key="mnu_1">
                <a href="/calc">Calc</a>
              </li>
              <li key="mnu_2">
                <a href="/fedora">Fedora</a>
              </li>
              <li key="mnu_3">
                <a href="/tasks">Tasks</a>
              </li>
            </ul>
          </nav>
        </div>
        <div id="detail">

        <Card key="crd_1" prpGnr="f" prpName="Fedora" prpLastName="Pakita" prpProfession="Student"/>
        </div>
      </>
    );
  }
