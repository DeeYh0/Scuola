module com.deeyh.notes {
    requires javafx.controls;
    requires javafx.fxml;


    opens com.deeyh.notes to javafx.fxml;
    exports com.deeyh.notes;
}