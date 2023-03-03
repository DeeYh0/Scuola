module com.deeyh.notes {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.desktop;


    opens com.deeyh.notes to javafx.fxml;
    exports com.deeyh.notes;
}