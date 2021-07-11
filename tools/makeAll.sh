#!/bin/sh

# Entities
# php tools/makeEntity.php User id,name,surname,login
php tools/makeEntity.php Group id,name,desc
php tools/makeEntity.php Role id,name,desc

# User use-case
php tools/makeUseCaseEntity.php create User id,name,surname,login
php tools/makeUseCaseEntity.php read User id
php tools/makeUseCaseEntity.php update User id,name,surname,login
php tools/makeUseCaseEntity.php delete User id

# User Command
php tools/makeUseCaseEntityCommand.php create User id,name,surname,login
php tools/makeUseCaseEntityCommand.php read User id
php tools/makeUseCaseEntityCommand.php update User id,name,surname,login
php tools/makeUseCaseEntityCommand.php delete User id

# User Command handler
php tools/makeUseCaseEntityCommandHandler.php create User id,name,surname,login
php tools/makeUseCaseEntityCommandHandler.php read User id
php tools/makeUseCaseEntityCommandHandler.php update User id,name,surname,login
php tools/makeUseCaseEntityCommandHandler.php delete User id

# Group use-case
php tools/makeUseCaseEntity.php create Group id,name,desc
php tools/makeUseCaseEntity.php read Group id
php tools/makeUseCaseEntity.php update Group id,name,desc
php tools/makeUseCaseEntity.php delete Group id

# Group Command
php tools/makeUseCaseEntityCommand.php create Group id,name,desc
php tools/makeUseCaseEntityCommand.php read Group id
php tools/makeUseCaseEntityCommand.php update Group id,name,desc
php tools/makeUseCaseEntityCommand.php delete Group id

# Group Command handler
php tools/makeUseCaseEntityCommandHandler.php create Group id,name,desc
php tools/makeUseCaseEntityCommandHandler.php read Group id
php tools/makeUseCaseEntityCommandHandler.php update Group id,name,desc
php tools/makeUseCaseEntityCommandHandler.php delete Group id

# Role use-case
php tools/makeUseCaseEntity.php create Role id,name,desc
php tools/makeUseCaseEntity.php read Role id
php tools/makeUseCaseEntity.php update Role id,name,desc
php tools/makeUseCaseEntity.php delete Role id

# Role Command
php tools/makeUseCaseEntityCommand.php create Role id,name,desc
php tools/makeUseCaseEntityCommand.php read Role id
php tools/makeUseCaseEntityCommand.php update Role id,name,desc
php tools/makeUseCaseEntityCommand.php delete Role id

# Role Command handler
php tools/makeUseCaseEntityCommandHandler.php create Role id,name,desc
php tools/makeUseCaseEntityCommandHandler.php read Role id
php tools/makeUseCaseEntityCommandHandler.php update Role id,name,desc
php tools/makeUseCaseEntityCommandHandler.php delete Role id
