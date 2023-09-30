public record Studente(String nome, String cognome, int eta) {
    @Override
    public String toString() {
        return "Nome: " + nome + ", Cognome: " + cognome + ", Età: " + eta;
    }
}
