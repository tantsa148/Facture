<div class="modal fade"
     id="ajouterUtilisateurModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="ajouterUtilisateurModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="ajouterUtilisateurModalLabel">
                    Ajouter un utilisateur
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Fermer">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form method="POST"
                  action="{{ route('utilisateur.store') }}">

                @csrf

                <div class="modal-body">

                    <div class="form-group">

                        <label for="nom">
                            Nom
                        </label>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom') }}"
                            class="form-control"
                            placeholder="Entrez le nom"
                            required
                        >

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Annuler
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>