<div class="modal fade"
     id="voirUtilisateurModal{{ $utilisateur->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="voirUtilisateurModalLabel{{ $utilisateur->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="voirUtilisateurModalLabel{{ $utilisateur->id }}">
                    Détails de l'utilisateur
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Fermer">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>ID</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $utilisateur->id }}"
                           readonly>
                </div>

                <div class="form-group">
                    <label>Nom</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $utilisateur->nom }}"
                           readonly>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    Fermer
                </button>

            </div>

        </div>

    </div>

</div>