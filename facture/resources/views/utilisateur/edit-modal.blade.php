<div class="modal fade"
     id="modifierUtilisateurModal{{ $utilisateur->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modifierUtilisateurModalLabel{{ $utilisateur->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modifierUtilisateurModalLabel{{ $utilisateur->id }}">

                    Modifier l'utilisateur

                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Fermer">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form method="POST"
                  action="{{ route('utilisateur.update', $utilisateur->id) }}">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="form-group">

                        <label for="nom{{ $utilisateur->id }}">
                            Nom
                        </label>

                        <input
                            type="text"
                            id="nom{{ $utilisateur->id }}"
                            name="nom"
                            value="{{ old('nom', $utilisateur->nom) }}"
                            class="form-control"
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
                            class="btn btn-warning">

                        <i class="fa-solid fa-pen"></i>
                        Modifier

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>